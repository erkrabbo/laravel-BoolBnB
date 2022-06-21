<template>
  <div class="col">
    <a :href="'/houses/' + house.id">
        <div class="card h-100 border-0 custom-rounded" ref="card">
            <!-- startsWith("Welcome to earth.","Welcome"); -->
            <img class="card-img" :src="setImage(house.gallery[imgIndex])" :alt="house.Title" ref="preview">

            <div class="card-img-overlay h-100 d-flex flex-column gradient" ref="overlay">
                <!-- <span class="align-self-start ms-auto" @click.prevent="handleLike">ciao</span> -->
                <div class="info text-center mt-auto text-white" ref="infos">
                    <h1 class="text-start">{{house.Title}}</h1>
                    <div class="text-start">
                        <h5>{{house.Night_price / 100}} €/notte</h5>
                        <small>{{house.Address}}</small>
                    </div>
                </div>
                <div class="w-100 d-flex my-auto justify-content-between d-none" ref="imageControls">
                    <button ref="prevImage">&leftarrow;</button>
                    <button ref="nextImage">&RightArrow;</button>
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
.pallina {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #fff;
    margin: 0 5px;
    &.active {
        background: grey;
    }
}

</style>
