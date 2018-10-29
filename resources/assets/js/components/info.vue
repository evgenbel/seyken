<template>
    <div>
    <div v-show="Ccomp.user.fio">
        <div class="alert alert-primary" role="alert">
            Выступает боец:
            {{ Ccomp.user.fio }}

            <span v-show="Ccomp.kata_id"><br/>Ката: {{ Ccomp.kata.name }}</span>


            <div v-show="Cpoint" class="h2 text-danger">
                <span>За раунд {{ Cpoint|rounded }}</span>
                <span class="text-success">Общий балл {{ sum|rounded }}</span>
            </div>
        </div>
    </div>
    <div class="alert alert-primary" v-show="!Ccomp.user.fio">
        Ожидается следующий боец
    </div>
    </div>
</template>

<script>

    export default {
        props:['c', 'point', 'cid', 'itog'],
        data: function(){
            let default_data = {
                Ccomp: this.c || {weight:'', kate_id:1, kata:{name:''}, user:{fio:''}},
                Cpoint: this.point,
                interval:{},
                sum:this.itog
            }
            if (!default_data.Ccomp.kata){
                default_data.Ccomp.kata = {name:''}
            }
            if (!default_data.Ccomp.user){
                default_data.Ccomp.user = {fio:''}
            }
          return default_data;
        },
        mounted() {
            window.Echo.channel('change-competitor')
                .listen('.UserUpdated', (e) => {
                    console.log(e.user);
                    this.Ccomp = e.user;
                    this.Cuser = e.user.user;
                }).listen('.PointUpdated', (e) => {
                    this.Cpoint = e.points.current;
                    this.sum = e.points.sum;
                });
        },
        computed: {

        },
        methods: {
            loadData: function(){
                // axios.get('api/cinfo').then(function(response){
                //     // console.log(response);
                //     this.Ccomp = response.data || {weight:'', kate_id:'', kata:{name:''}};
                //     this.Cuser = response.data.user;
                //     this.Cpoint = this.$root.$options.filters.rounded(response.data.point);
                //     this.sum = this.$root.$options.filters.rounded(response.data.sum);
                // }.bind(this), function(response){
                //     // error callback
                //     console.log(response);
                // });
            }
        },
        beforeDestroy: function(){
            clearInterval(this.interval);
        }
    }
</script>
