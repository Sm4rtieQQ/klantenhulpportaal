import type { User } from "@/helpers/types";
import { storeModuleFactory } from "@/services/store";
import { ComputedRef, ref } from "vue";

const userStore = storeModuleFactory('users');
export const usersInitialized = ref(false);
export const adminsInitialized = ref(false);

export const users: ComputedRef<any[]> = userStore.getters.all;
export const admins: ComputedRef<any[]> = userStore.getters.getByFieldValue('admin', true);

export const clearUsers = () => {
    userStore.setters.clear();
    usersInitialized.value = false;
    adminsInitialized.value = false;
}

export const loadUsers = async () => {
    await userStore.actions.getAll();
    usersInitialized.value = true;
}

export const loadAdmins = async () => {
    await userStore.actions.getByFields({ admin: true });
    adminsInitialized.value = true;
}

export const getUser = (id: number) => {
    return userStore.getters.getById(id);
}

export const getUsersSortedBy = (columnName: string, asc: boolean = true): ComputedRef<User[]> => {
    return userStore.getters.sortedByField(columnName, asc) as ComputedRef<User[]>;
}

export const updateUser = async (id: number, data: any) => {
    await userStore.actions.update(id, data);
}

export const deleteUser = async (id: number) => {
    await userStore.actions.delete(id);
}
