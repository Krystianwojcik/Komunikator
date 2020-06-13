
<template>
   <div class="row">

    <div class="col-md-3">
            <div class="card card-default mb-3">
                <div class="card-header secondary-color white-text">Szukaj przyjaciół</div>
                <div class="card-body">
                   <search @fetchFriends="fetchFriends"/>
    
                </div>
            </div>
            <div class="card card-default mb-3">
                <div class="card-header default-color white-text">Aktywni użytkownicy</div>
                <div class="card-body">
                   
                    <ul class="list-unstyled d-flex flex-column m-0">
                      <template v-for="(activeFriend, index) in activeFriendsFilter">
                              <friend  @changeGroupUser="changeGroupUser" v-if="activeFriend.id != user.id" :id="activeFriend.id" :name="activeFriend.name" :surname="activeFriend.surname" :key="index" />
                      </template>
                    </ul>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header default-color-dark white-text">Wszyscy użytkownicy</div>
                <div class="card-body">
                    <ul class="list-unstyled d-flex flex-column m-0">
                       <friend  @changeGroupUser="changeGroupUser" v-for="friend in friends" :id="friend.id" :name="friend.name" :surname="friend.surname"/>
                    </ul>
                </div>
            </div>
        </div>

       <div class="col-md-6 message-box">
           <div class="card card-default">
               <div class="card-header primary-color white-text"> <h2 class="display text-center">Wiadomości <strong><em>{{actualGroupeName}}</em></strong></h2></div>
               <div class="card-body p-0">
                  <ul class="list-unstyled d-flex flex-column" v-chat-scroll>
                      <template  v-for="message in messages" >
                          <message :text="message.message" :userID="message.user_id" :userloggedID="user.id"/>
                      </template>
                   
                      
                        </ul>
               </div>
               <input
                    @keydown="sendTypingEvent"
                    @keyup.enter="sendMessage"
                    v-model="newMessage"
                    type="text"
                    name="message"
                    placeholder="Wpisz treść wiadomości..."
                    class="form-control">
           </div>
            <span class="text-muted" v-if="activeUser" >{{ activeUser.name }} is typing...</span>
       </div>
    <div class="col-md-3">
            <div class="card card-default">
                <div class="card-header primary-color-dark white-text">Twoje grupy</div>
                <div class="card-body">
                    <ul class="list-unstyled d-flex flex-column">
                       <gruop @changeGroup="changeGroup" v-for="(group, index) in gruops" :key="index" :id="group.id" :name="group.name"/>
                    </ul>
                </div>
            </div>
        </div>
   </div>
</template>

<script>
    export default {
        props:['user'],
        data() {
            return {
                messages: [],
                gruops: [],
                friends: [],
                newMessage: '',
                activeFriends:[],
                activeFriendsFilter:[],
                activeUser: false,
                typingTimer: false,
                actualGroupeID: '',
                actualGroupeName: '',
            }
        },
        watch: {
            activeUser: function () {
                if(this.activeUser == false) {
              console.log('refresh');
                    this.fetchMessages(this.actualGroupeID);
                }
            },
            activeFriends: function () {  
                for (var i = 0; i < this.friends.length; i++) {
                    for (var j = 0; j < this.activeFriends.length; j++) {
                        if(this.friends[i].name == this.activeFriends[j].name) {
                            this.activeFriendsFilter.push(this.friends[i]);
                        }
                    }
                }
            }
 
        },
        created() {
            this.fetchFriends();
            this.fetchGroups();
            this.fetchMessages(this.actualGroupeID);
            Echo.join('chat')
                .here(user => {
                    this.activeFriends = user;
                })
                .joining(user => {
                    this.activeFriends.push(user);
                })
                .leaving(user => {
                    this.activeFriends = this.activeFriends.filter(u => u.id != user.id);
                })
                .listen('ChatEvent',(event) => {
                    this.messages.push(event.chat);
                })
                .listenForWhisper('typing', user => {
                   this.activeUser = user;
                    if(this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }
                   this.typingTimer = setTimeout(() => {
                       this.activeUser = false;
                   }, 1000);
                })
        },
        methods: {
            fetchMessages(id) {
                if(id) {
                    axios.get('messages/'+id+'/').then(response => {
                        this.messages = response.data;
                    })
                }
            },
            fetchGroups() {
                axios.get('gruops').then(response => {
                    this.gruops = response.data;
                })
            },
            fetchFriends() {
                axios.get('friends').then(response => {
                    this.friends = response.data;
                })
            },
            sendMessage() {
                this.messages.push({
                    user: this.user,
                    message: this.newMessage,
                    groupID: this.actualGroupeID,
                    user_id: this.user.id
                                        
                });
                axios.post('messages', {message: this.newMessage, groupID: this.actualGroupeID});
                this.newMessage = '';
                
            },
            sendTypingEvent() {
                Echo.join('chat')
                    .whisper('typing', this.user);
                console.log(this.user.name + ' is typing now')
            },
            changeGroup(group){
              this.actualGroupeID = group[0];
              this.actualGroupeName = group[1];
                this.fetchMessages(group[0]);
                this.newMessage = '';
          },
            changeGroupUser(userID){
            axios.get('gruops-check/'+userID+'/').then(response => {
                this.actualGroupeID = response.data;
                this.fetchMessages(this.actualGroupeID);
                console.log('changeGroup');
                
            })
          },
        }
    }
   
</script> 