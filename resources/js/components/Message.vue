<template>
  <mdb-media tag="div" class="mb-2" :class="this.position">
    <mdb-media-image tag="div" circle :class="this.imageClass" src="https://mdbootstrap.com/img/Photos/Others/placeholder7.jpg" alt="" />
    <mdb-media-body>
          <p class="m-0">{{text}}</p>
    </mdb-media-body>
  </mdb-media>
</template>



<script>
  import {mdbMedia, mdbMediaBody, mdbMediaImage } from 'mdbvue';
  export default {
    data: {
        position: '',
        imageClass: '',
    },
    components: {
      mdbMedia,
      mdbMediaBody,
      mdbMediaImage
    },
      
        props:{
            text: {
                type: String,
                required: true
            },
            userID: {
                type: Number,
                required: true
            },
            userloggedID: {
                type: Number,
                required: true
            }
        },
      computed: {
          position: function () {
              if(this.userID == this.userloggedID) {
                  return 'd-flex justify-content-end flex-row-reverse right '
              } else {
                  return 'd-flex justify-content-start align-self-start left'
              }
          },
          imageClass: function () {
              if(this.userID == this.userloggedID) {
                  return 'd-flex justify-content-end flex-row-reverse align-self-end  mx-3 right '
              } else {
                  return 'd-flex justify-content-start align-self-start mx-3  left'
              }
          }
      }
  }
</script>




<style scoped>

.right .media-body {
    text-align: right;
}
.left .media-body {
    text-align: left;
}
</style>