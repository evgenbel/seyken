<template>
    <div class="container">
        <div class="justify-content-center">
            <h1>{{ competition.name}}</h1>
            <h3>Проводится с {{ competition.start }} по {{ competition.end }}</h3>

            <!--<competition-round :round="competition.round"></competition-round>-->
            <!--<competition-info :cid="cid" :user="competition.currentCompetitor" :c="competition" :point="0"></competition-info>-->
        </div>
    </div>
</template>

<script>

    export default {
        props:['competition', 'cid'],
        data: function(){
            return {

            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        computed: {

        },
        methods: {

        }
    }
</script>
