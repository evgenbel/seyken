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
              currentGroup: this.group
          }
        },
        mounted() {
            window.Echo.channel('change-round')
                .listen('.RoundUpdated', (e) => {
                    this.currentRound = e.round;
                    this.currentGroup = e.group;
                });
        },
        computed: {

        },
        methods: {
            fetchRound: function(){
            }
        },
        beforeDestroy: function(){
            clearInterval(this.interval);
        }
    }
</script>
