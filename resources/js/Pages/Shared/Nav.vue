<template>
    <nav class="ml-6">
        <ul class="menu menu-horizontal bg-base-100 rounded-box">
            <li><a href="/">Marketplace</a></li>
            <li><NavLink href="/inertiajs" :active="$page.component == 'Home'">Home</NavLink></li>
            <li><NavLink href="/inertiajs/users" :active="$page.component == 'Users'">Users</NavLink></li>
            <li><NavLink href="/inertiajs/settings" :active="$page.component == 'Settings'">Settings</NavLink></li>
            <li><NavLink href="/logout" method="post">Log Out</NavLink>
            </li>
        </ul>
    </nav>
</template>

<script>
import NavLink from "./NavLink";

export default {
    components: { NavLink },
};
</script>

<style scoped>

</style>
