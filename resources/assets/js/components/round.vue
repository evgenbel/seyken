<template>
    <div class="alert alert-primary" id="round-field">
        Раунд {{ currentRound }}
    </div>
</template>

<script>
    export default {
        props:['round'],
        data: function(){
          return {
              currentRound: this.round,
              interval:{}
          }
        },
        mounted() {
            this.interval = setInterval(function(){
                this.fetchRound();
            }.bind(this), 3000);
        },
        computed: {

        },
        methods: {
            fetchRound: function(){
                axios.get('api/round').then(function(response){
                    this.currentRound =  response.data;
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
