<template>
    <Head title="My App">
        <meta type="description" content="Generic information" head-key="description">
    </Head>

    <section class="p-6">
        <header class="flex max-w-4xl mx-auto">
            <div class="flex items-center">
                <h1 class="font-bold text-lg py-2.5">My App</h1>
                <p class="text-sm ml-4">Welcome Back, {{ username }}</p>
            </div>
            <Nav></Nav>
        </header>
    </section>

    <section class="p-6">
        <div class="max-w-4xl mx-auto">
            <slot></slot>
        </div>
    </section>
</template>

<script>
import Nav from "./Nav";

export default {
    components: {Nav},
    computed: {
        username() {
            return this.$page.props.auth.user.username;
        }
    }
}
</script>

<style scoped>

</style>
