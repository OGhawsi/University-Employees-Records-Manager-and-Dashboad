<template lang="">
    <div class="text-sky-500 hover:underline cursor-pointer hover:text-sky-600">
        <Link :href="href" class="flex space-x-1 items-center">
            <icon name="plus" class="h-5 w-5" />
            <span class="text-sm font-medium capitalize">add new</span>
        </Link>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';
import Icon from '@/Components/Icon.vue';
export default {
    components: {
        Link,
        Icon
    },
    props: {
        href: String,
    }
}
</script>