import { User } from "@/helpers/types";
import { storeModuleFactory } from "@/services/store";
import { ComputedRef, ref } from "vue";

const userStore = storeModuleFactory('users');
export const adminsInitialized = ref(false);
export const admins = userStore.getters.all;

export const clearUsers = () => {
    userStore.setters.clear();
    adminsInitialized.value = false;
}

export const getAdmins = async () => {
    await userStore.actions.getByFields({ admin: true });
    adminsInitialized.value = true;
}

export const getAdminsSortedBy = (columnName: string, asc: boolean): ComputedRef<User[]> => {
    return userStore.getters.sortedByField(columnName, asc) as ComputedRef<User[]>;
}