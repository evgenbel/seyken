<template>
    <table class="table">
        <tr>
            <th>Место</th>
            <th>Участник</th>
            <th>Год рождения</th>
            <th>Баллы</th>
        </tr>
        <tr v-for="competitor in competitors" :class="{disabled:competitor.disabled}">
            <td>{{competitor.num}}</td>
            <td>{{competitor.fio}}</td>
            <td>{{competitor.date_birth.date | moment("YYYY")}}</td>
            <td>{{competitor.point|rounded}}</td>
        </tr>
    </table>
</template>

<script>
    export default {
        data: function(){
          return {
              competitors: [],
              interval:{}
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
