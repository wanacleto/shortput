<template>
<homeLayout>
    <div style="margin-top: 80px">        
        <div v-for="(erro, index) in errors" :key="index" style="border: 2px solid red; margin-bottom:10px;" >
            {{ erro}}
        </div>
         <form @submit.prevent="handleForm">
            <input type="text" placeholder="Nome" v-model="form.name">
            <input type="email" placeholder="Email" v-model="form.email">
            <input type="password" placeholder="Passowrd" v-model="form.password"> 
            <button type="submit">Cadastrar</button>

         </form>
    </div>
 </homeLayout>   
</template>

<script>
    import HomeLayout from './../../Layouts/HomeLayout'
    
    export default {
        props: {
            errors: Object,
        },
        components: {HomeLayout},
        data: () => {
            return {
                form: {
                    name: null,
                    email: null,
                    password: null,
                }
            }
        },
        methods: {
            handleForm(){
                alert("O form foi sumitado")
                this.$inertia.post('/register', this.form)
            }

        }
    }
</script>
