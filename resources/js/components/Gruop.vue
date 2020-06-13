<template>
<div @click="changeGroup">
    
     <mdb-media tag="li" class="mb-2 select-group">
    <mdb-media-image tag="div" circle class="d-flex align-self-center mr-3" src="https://mdbootstrap.com/img/Photos/Others/placeholder7.jpg" alt="" />
    <mdb-media-body class="d-flex align-self-center">
      <div>
          <h3 class="mt-0">{{name}}</h3>
      </div>
    </mdb-media-body>
  </mdb-media>
</div>
</template>



<script>
  import {mdbMedia, mdbMediaBody, mdbMediaImage } from 'mdbvue';
  export default {
    components: {
      mdbMedia,
      mdbMediaBody,
      mdbMediaImage
    },
      props:{
          id: {
              type: Number,
              required: true
          },
          name: {
              type: String,
              required: true
          }
      },
        methods: {
            changeGroup() {
                this.$emit('changeGroup', [this.id, this.name]);
            }
        }
  }
</script>



<style scoped>

</style>