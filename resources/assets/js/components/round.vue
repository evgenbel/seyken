<template>
    <div class="alert alert-primary" id="round-field">
        Раунд {{ currentRound }}
        Категория {{ currentGroup }}
    </div>
</template>

<script>
    export default {
        props:['round', 'group'],
        data: function(){
          return {
              currentRound: this.round,
              currentGroup: this.group,
              interval:{}
          }
        },
        mounted() {
            this.fetchRound();
            this.interval = setInterval(function(){
                this.fetchRound();
            }.bind(this), 3000);
        },
        computed: {

        },
        methods: {
            fetchRound: function(){
                axios.get('api/round').then(function(response){
                    this.currentRound =  response.data.round;
                    this.currentGroup =  response.data.group;
                }.bind(this), function(response){
                    // error callback
                    console.log(response);
                });
            }
        },
        beforeDestroy: function(){
            clearInterval(this.interval);
        }
    }
</script>
