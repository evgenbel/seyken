<template>
    <div>
        <div v-show="cc.kata_id" class="alert alert-danger" role="alert">
            Необходимо выбрать какое ката показывается
        </div>

        <form method="post" :action="url">
            <div v-show="kate_select()">
                <div v-for="kate in kates" class="form-check">
                    <input v-model="cc.kate_id" class="form-check-input" type="radio" name="kata" :id="kate_id(kate.id)"
                           :value="kate.id">
                    <label class="form-check-label" :for="kate_id(kate.id)">
                        {{ kate.name }} ({{ kate.koef }})
                    </label>
                </div>
            </div>

            <input type="hidden" name="action" v-model="cc.id"/>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button v-if="cc.kate_id" v-on:click.prevent="change_kata()" class="btn btn-primary">
                        Сменить ката
                    </button>
                    <button v-else type="submit" class="btn btn-primary">
                        Выбрать
                    </button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>

    export default {
        props:['c', 'url', 'kates'],
        data: function(){
            let default_data = {
                cc: this.c || {id:0, kate_id:0},
                need_select_kate: false// !this.c.kate_id
            }
          return default_data;
        },
        mounted() {
            window.Echo.channel('change-competitor')
                .listen('.UserUpdated', (e) => {
                    // console.log(e.user);
                    // this.Ccomp = e.user;
                    // this.Cuser = e.user.user;
                }).listen('.PointUpdated', (e) => {
                    // this.Cpoint = e.points.current;
                    // this.sum = e.points.sum;
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
            },
            kate_id: function(kate){
                return 'kate_'+kate;
            },
            kate_select: function(){
                return this.need_select_kate;
            },
            change_kata:function(){
                if (this.need_select_kate){
                    console.log(this.url);
                    // axios.post(this.url, {
                    //     data:{
                    //         action: this.cc.id,
                    //         kata: this.cc.kate_id
                    //     }
                    // });
                }else{
                    this.need_select_kate=true
                }
            }
        },
        beforeDestroy: function(){
            clearInterval(this.interval);
        }
    }
</script>
