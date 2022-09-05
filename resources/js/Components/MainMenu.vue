<script setup lang="ts">
import MenuItem from "./MenuItem.vue";
</script>

<template>
    <div class="menu">
        <MenuItem name="dashboard" label="Dashboard" />
        <MenuItem name="organizations" label="Organizations" />
        <MenuItem name="contacts" label="Contacts" />
        <MenuItem name="reports" label="Reports" />
    </div>
</template>
