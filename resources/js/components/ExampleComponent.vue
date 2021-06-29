<template>
    <div class="card">
        ...
                <ol>
                    <li v-for="user in users" :key="user.id">
                        {{ user.prenom }} [<a :href="'mailto:' + user.email ">{{ user.email }}</a>], créé le {{ user.created_at }}
                    </li>
                </ol>
      ...
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('ExampleComponent mounted.')
        },
        props: {
            users: Array
        }
    }
</script>