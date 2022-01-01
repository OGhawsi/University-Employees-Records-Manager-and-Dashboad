<template>
        <div v-if="rank.academic_rank === '1'"> Teaching Assistant</div>
        <div v-if="rank.academic_rank === '2'"> Senior Teaching Assistant</div>
        <div v-if="rank.academic_rank === '3'"> Assist. Prof.</div>
        <div v-if="rank.academic_rank === '4'"> Senior Assist. Prof.</div>
        <div v-if="rank.academic_rank === '5'"> Associate Prof.</div>
        <div v-if="rank.academic_rank === '6'"> Senior Assoc. Prof.</div>
        <div v-if="rank.academic_rank === '7'"> Professor</div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components: {
        Link,
    },
    props: {
        rank:Object,
    }
}
</script>