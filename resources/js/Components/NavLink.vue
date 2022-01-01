<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },

    props: ['href', 'active'],

    computed: {
        classes() {
            return this.active
                ? 'inline-flex items-center px-1 pt-1 border-b-2 border-sky-100 text-sm font-medium leading-5 text-white focus:outline-none focus:border-sky-100 transition  duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-sky-100 hover:text-white hover:border-sky-100 focus:outline-none focus:text-white focus:border-sky-100 transition duration-150 ease-in-out'
        }
    }
}
</script>
