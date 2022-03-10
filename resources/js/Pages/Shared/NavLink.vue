<template>
    <Link class="text-blue-500 hover:underline" :class="{'font-bold underline': active}">
        <slot></slot>
    </Link>
</template>

<script>

export default {
    components: {  },
    props: {
        active: Boolean
    }
}
</script>

<style scoped>

</style>
