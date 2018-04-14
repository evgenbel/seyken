<template>
    <div v-if="Cuser">
        <div class="alert alert-primary" role="alert">
            Выступает боец:
            {{ Cuser.fio }}
            {{ Cuser.date_birth | moment("YYYY")}} г.р.
            <br/>Вес: {{ Ccomp.weight }} кг.

            <span v-if="Ccomp.kate_id"><br/>Ката: {{ Ccomp.kata.name }}</span>


            <div v-if="Cpoint" class="h2 text-danger">Общий балл {{ Cpoint|rounded }}</div>
        </div>
        <!--<table-result v-if="cid"></table-result>-->
        <!--<div v-else></div>-->
    </div>
    <div class="alert alert-primary" v-else>
        Ожидается следующий боец
    </div>
</template>

<script>

    export default {
        props:['c', 'point', 'user', 'cid'],
        data: function(){
            let default_data = {
                Ccomp: this.c || {weight:'', kate_id:'', kata:{name:''}},
                Cpoint: this.point,
                Cuser: this.user,
                interval:{}
            }
            console.log(default_data);
          return default_data;
        },
        mounted() {
            this.interval = setInterval(function(){
                this.loadData();
            }.bind(this), 4000);
        },
        computed: {

        },
        methods: {
            loadData: function(){
                axios.get('api/cinfo').then(function(response){
                    // console.log(response);
                    this.Ccomp = response.data || {weight:'', kate_id:'', kata:{name:''}};
                    this.Cuser = response.data.user;
                    this.Cpoint = this.$root.$options.filters.rounded(response.data.point);
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
