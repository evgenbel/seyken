<template>
    <table class="table table-striped table-sm">
        <tr>
            <th>Место</th>
            <th>Участник</th>
            <th>Год рождения</th>
            <th v-for="round in rounds">Раунд {{round}}</th>
            <th>Итого</th>
        </tr>
        <tr v-for="competitor in competitors" :class="{disabled:competitor.disabled}">
            <td>{{competitor.num}}</td>
            <td>{{competitor.fio}}</td>
            <td>{{competitor.date_birth.date | moment("YYYY")}}</td>
            <td v-for="point in competitor.points">{{point.point|rounded}}</td>
            <td>{{competitor.point|rounded}}</td>
        </tr>
    </table>
</template>

<script>
    export default {
        data: function(){
          return {
              competitors: [],
              interval:{},
              rounds:[1],
              points:[0],
          }
        },
        mounted() {
            this.loadData();
            this.interval = setInterval(function(){
                this.loadData();
            }.bind(this), 3000);
        },
        computed: {

        },
        methods: {
            loadData: function(){
                axios.get('api/roundResult').then(function(response){
                    this.competitors =  response.data;
                    this.rounds = [];
                    for(let i=1; i<=this.competitors[0].round; i++){
                        this.rounds.push(i);
                    }

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
