<template>
<div class="d-flex align-items-center m-0">
    
      <mdb-input class="d-flex m-0" v-model="email" label="Podaj email" type="email"/>
      <mdb-btn @click="addFriend" :disabled="!canAdd"  color="secondary" class="d-flex btn-sm">Szukaj</mdb-btn>
</div>
</template>


<script>
  import { mdbInput, mdbBtn } from 'mdbvue';
  export default {
    components: {
      mdbInput,
      mdbBtn
    },
        computed:{
            canAdd(){
                return this.email.trim().length >= 1;
            }
        },
      data() {
            return {
                email: '',
                alert: '',
            }
      },
      watch: {
            alert: function () {
                if(this.alert) {
                   alert(this.alert);
                      if(this.alert == 'Dodałeś przyjaciela') {
                          this.$emit('fetchFriends');
                      }
                   }
            },
        },
      methods: {
          addFriend() {
              this.email = axios.get('add-friends/'+this.email+'/').then(response => {
                        this.alert = response.data;
                    });

              this.alert = '';
              this.email = '';
         
          }
      }
  }
</script>