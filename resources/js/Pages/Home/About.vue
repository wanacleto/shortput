<template>
<homeLayout>
    <div>
         <h1>Ola {{user.name}} voce esta na About</h1>
    </div>
 </homeLayout>   
</template>

<script>
    import HomeLayout from './../../Layouts/HomeLayout'
    
    export default {
        props: {
            user: String
        },
        components: {HomeLayout}
    }
</script>
