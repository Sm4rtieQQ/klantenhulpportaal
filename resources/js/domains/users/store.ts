import { User } from "@/helpers/types";
import { storeModuleFactory } from "@/services/store";
import { ComputedRef, ref } from "vue";

const adminStore = storeModuleFactory('admins')
const userStore = storeModuleFactory('users');
export const adminsInitialized = ref(false);
export const usersInitialized = ref(false);

export const admins = adminStore.getters.all;
export const users = userStore.getters.all;

export const clearUsers = () => {
    adminStore.setters.clear();
    userStore.setters.clear();

    adminsInitialized.value = false;
    usersInitialized.value = false;
}

export const loadUsers = async () => {
    await userStore.actions.getAll();
    usersInitialized.value = true;
}

export const loadAdmins = async () => {
    await adminStore.actions.getByFields({ admin: true });
    adminsInitialized.value = true;
}

export const getUser = (id: number) => {
    return userStore.getters.getById(id);
}

export const getUsersSortedBy = (columnName: string, asc: boolean = true): ComputedRef<User[]> => {
    return userStore.getters.sortedByField(columnName, asc) as ComputedRef<User[]>;
}

export const getAdminsSortedBy = (columnName: string, asc: boolean): ComputedRef<User[]> => {
    return adminStore.getters.sortedByField(columnName, asc) as ComputedRef<User[]>;
}

export const updateUser = (id: number, data: any) => {
    userStore.actions.update(id, data);
}

export const deleteUser = async (id: number) => {
    await userStore.actions.delete(id);
}