<template>
<homeLayout>
    <div>
         <h1>Ola {{user}} voce esta na Home</h1>
        <div v-if="$page.flash.success" style="border: 2px solid green; margin-top: 10px; ">
            {{$page.flash.success}}
        </div>
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
