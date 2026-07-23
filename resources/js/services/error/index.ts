import { computed, ref } from 'vue';

interface ErrorBag {
    [property: string]: string[];
}

const errorBag = ref<ErrorBag>({});
const message = ref('');

export const getErrorBag = computed(() => errorBag.value);
export const getMessage = computed(() => message.value);

export const getErrorByProperty = (property: string) =>
    computed(() => {
        const errors = errorBag.value[property];
        return Array.isArray(errors) && errors.length > 0 ? errors[0] : '';
    });

export const setErrorBag = (bag: ErrorBag) => {
    errorBag.value = bag || {};
};
export const setMessage = (newMessage: string) => {
    message.value = newMessage || 'Er is een fout opgetreden.';
}

export const destroyErrors = () => (errorBag.value = {});
export const destroyMessage = () => (message.value = '');