<template>
  <layout title="Users">
    <div v-for="user in users" :key="user.id">
      <inertia-link :href="`/users/${user.id}`">
        {{ user.name }}
      </inertia-link>
      <div>{{ user.email }}</div>
    </div>
  </layout>
</template>

<script>
//import Layout from '../Shared/Layout'

export default {
  components: {
    Layout,
  },
  props: {
    users: Array,
  },
}
</script>
Our gold sponsors:
 