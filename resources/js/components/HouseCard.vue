<template>
  <div class="col">
    <a :href="'/houses/' + house.id">
        <div class="card h-100 border-0 custom-rounded" ref="card">
            <!-- startsWith("Welcome to earth.","Welcome"); -->

            <img class="card-img " :src="setImage(house.gallery[imgIndex])" :alt="house.Title" ref="preview">

            <div class="card-img-overlay h-100 d-flex flex-column gradient" ref="overlay">

                <i v-if="house.sponsored" class="fa-solid fa-gem text-white bg-success rounded p-1 align-self-start"></i>
                <div class="info text-center mt-auto text-white" ref="infos">
                    <h1 class="text-start mt-2">{{house.Title}}</h1>
                    <div class="text-start">
                        <h5>{{ Math.round(house.Night_price)}} €/notte</h5>
                        <small>{{house.Address}}</small>
                    </div>
                </div>
                <div class="w-100 d-flex my-auto justify-content-between d-none" ref="imageControls">
                    <button ref="prevImage" class="arrows"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 12px; width: 12px; stroke: currentcolor; stroke-width: 4; overflow: visible;"><g fill="none"><path d="m20 28-11.29289322-11.2928932c-.39052429-.3905243-.39052429-1.0236893 0-1.4142136l11.29289322-11.2928932"></path></g></svg></button>
                    <button ref="nextImage" class="arrows"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 12px; width: 12px; stroke: currentcolor; stroke-width: 4; overflow: visible;"><g fill="none"><path d="m12 4 11.2928932 11.2928932c.3905243.3905243.3905243 1.0236893 0 1.4142136l-11.2928932 11.2928932"></path></g></svg></button>
                </div>
                <div class="d-flex justify-content-center">
                    <div v-for="(image, index) in house.gallery" :key="index * -1" :class="index == imgIndex ? 'pallina active' : 'pallina'"></div>
                </div>
            </div>
        </div>
    </a>
  </div>
</template>

<script>

export default {
    props:{
        house: {
            type: Object,
            required: true
        }
    },
    data(){
        return {
            imgIndex: 0,
            start: null,
            moveDelta: 0,
            endDelta: 0,
            moveVertical: 0,
            endVertical: 0,
        }
    },
    methods: {
        // handleLike(){
        //     console.log('like')
        // }
        setImage(string) {
            const image = string.startsWith('http') ? string : `/storage/${string}`;
            return image
        }
    },
    mounted(){
        const tap = ("ontouchstart" in this.$refs.card);
        if(!tap) {
            this.$refs.card.addEventListener('mouseenter', () => {
                this.$refs.infos.classList.add('d-none')
                this.$refs.imageControls.classList.remove('d-none')
                this.$refs.overlay.classList.toggle('gradient')
            })
            this.$refs.card.addEventListener('mouseleave', () => {
                this.$refs.infos.classList.remove('d-none')
                this.$refs.imageControls.classList.add('d-none')
                this.$refs.overlay.classList.toggle('gradient')
            })
        }
        // this.$refs.card.addEventListener('focus', () => {
        //     this.$refs.infos.classList.add('d-none')
        //     this.$refs.imageControls.classList.remove('d-none')
        //     this.$refs.overlay.classList.toggle('gradient')
        // })
        // this.$refs.card.addEventListener('blur', () => {
        //     this.$refs.infos.classList.remove('d-none')
        //     this.$refs.imageControls.classList.add('d-none')
        //     this.$refs.overlay.classList.toggle('gradient')
        // })
        this.$refs.card.addEventListener('touchstart', (e) => {
            this.moveDelta = 0;
            this.endDelta = 0;
            this.moveVertical = 0;
            this.endVertical = 0;
            this.start = e;
            if (this.start) {
                this.moveVertical = e.touches[0].pageY - this.start.touches[0].pageY;
                this.moveDelta = e.touches[0].pageX - this.start.touches[0].pageX;
                // console.log("Move delta: " + (e.touches[0].pageX - this.start.touches[0].pageX))
            }
        }, {passive: true})
        // this.$refs.card.addEventListener('touchmove', (e) => {
        //     if (this.start) {
        //         this.moveDelta = e.touches[0].pageX - this.start.touches[0].pageX;
        //         // console.log("Move delta: " + (e.touches[0].pageX - this.start.touches[0].pageX))
        //     }
        // }, {passive: true})
        this.$refs.card.addEventListener('touchend', (e) => {
            if (this.start) {
                this.endVertical = e.changedTouches[0].pageY - this.start.changedTouches[0].pageY;
                const difference = (this.moveVertical) - (this.endVertical);
                // const difference = this.moveVertical * this.moveVertical - (e.changedTouches[0].pageY) * (e.changedTouches[0].pageY);
                // console.log(difference)
                    // console.log(difference < 50 && difference > -50)
                if(difference < 50 && difference > -50 && difference != 0) {
                    this.endDelta = e.changedTouches[0].pageX - this.start.changedTouches[0].pageX;
                    // if (this.endDelta === this.moveDelta) return;

                    if (this.endDelta - this.moveDelta > 0) {
                        if(this.imgIndex > 0){
                            this.imgIndex--
                        } else {
                            this.imgIndex = this.house.gallery.length - 1
                        }
                    } else {
                        if(this.imgIndex < this.house.gallery.length - 1){
                            this.imgIndex++
                        } else {
                            this.imgIndex = 0
                        }
                    }
                }
                // console.log("End delta: " + this.endDelta)
                this.start = null;
            }
        }, {passive: true})
        this.$refs.prevImage.addEventListener('click', (e) => {
            e.preventDefault()
            if(this.imgIndex > 0){
                this.imgIndex--
            } else {
                this.imgIndex = this.house.gallery.length - 1
            }
        })
        this.$refs.nextImage.addEventListener('click', (e) => {
            e.preventDefault()
            if(this.imgIndex < this.house.gallery.length - 1){
                this.imgIndex++
            } else {
                this.imgIndex = 0
            }
        })
    }
    }
</script>

<style scoped lang="scss">
.card-img-overlay.gradient{
    background: linear-gradient(to bottom, transparent 0%, black 100%);
}
.card-img {
    height: 15rem;
    object-fit: cover;
}
.custom-rounded {
    border-radius: 1em;
    overflow: hidden;
}
.card {
    transition: transform 0.3s ease;
    &:hover {
        transform: scale(1.05);
    }
}

h1{
    font-size: 1.3em;
    font-weight: bold;
}

.pallina {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin: 0 5px;
    background: grey;
    &.active {
        background: #fff;
    }
}

.arrows{
    -webkit-box-pack: center;
    -webkit-box-align: center;
    appearance: none;
    display: inline-flex;
    border-radius: 50%;
    border: 1px solid rgba(0, 0, 0, 0.08);
    outline: none;
    color: rgb(34, 34, 34);
    background-color: rgba(255, 255, 255, 0.9);
    touch-action: manipulation;
    align-items: center;
    justify-content: center;
    background-clip: padding-box;
    box-shadow: transparent 0px 0px 0px 1px, transparent 0px 0px 0px 4px, rgb(0 0 0 / 18%) 0px 2px 4px;
    transition: -ms-transform 0.25s ease 0s, -webkit-transform 0.25s ease 0s, transform 0.25s ease 0s;
    width: 32px;
    height: 32px;
    &:hover {
        filter: brightness(70%);
    }
    &:active {
        filter: brightness(50%);
    }
}

</style>
