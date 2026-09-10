<script setup lang="ts">
import { deleteComment, getComment } from '@/domains/comments/store';
import { formatDate } from '@/helpers/formatters';
import type { Comment } from '@/helpers/types';
import { ref } from 'vue';
import Edit from '@/domains/comments/pages/Edit.vue';
import { useAuth } from '@/domains/auth/store';

const { user, isAdmin } = useAuth();

const props = withDefaults(defineProps<{ comments?: Comment[]; ticketId: number }>(), {
    comments: () => [],
});

const emit = defineEmits<{ saved: [] }>();

const currentEdit = ref<number | null>();

const toggleEdit = (id: number) => {
    currentEdit.value = id
};

const update = () => {
    emit('saved');
    currentEdit.value = null;
}

const destroy = async (id: number) => {
    await deleteComment(id);
    emit('saved');
}

</script>

<template>
    <div v-if="props.comments.length !== 0" v-for="comment in props.comments" :key="comment.id"
        class="my-4 p-4 bg-slate-300">
        <div v-if="currentEdit === comment.id">
            <Edit :comment="comment" :ticket-id="props.ticketId" @saved="update" />
        </div>
        <div v-else>
            <h4>{{ comment.created_by }}</h4>
            <p>{{ comment.body }}</p>
            <h6>{{ formatDate(comment.created_at) }}</h6>
            <div v-if="comment.created_by_id === user?.id || isAdmin()" class="flex gap-3">
                <a @click="toggleEdit(comment.id)" class="actionLink">Bewerken</a>
                <a @click="destroy(comment.id)" class="actionLink destroy">Verwijderen</a>
            </div>
        </div>
    </div>
    <div v-else class="italic">Geen reacties gevonden.</div>
</template>