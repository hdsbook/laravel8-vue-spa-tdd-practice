<template>
    <div class="flex flex-col items-center p-3">
        <div class="md:w-2/3 w-full">
            <div class="text-right">
                <Button class="success">Create news</Button>
            </div>
            <NewsList />
        </div>
    </div>
</template>

<script>
import NewsList from './NewsList.vue';
import Button from '../../components/Button';

export default {
    components: {
        NewsList,
        Button,
    }
}
</script>
