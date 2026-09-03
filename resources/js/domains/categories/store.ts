import { Category } from "@/helpers/types";
import { storeModuleFactory } from "@/services/store";
import { ComputedRef, ref } from "vue";

const categoryStore = storeModuleFactory('categories');
export const categoriesInitialized = ref(false);

export const loadCategories = async () => {
    await categoryStore.actions.getAll();
    categoriesInitialized.value = true;
}

export const categories = categoryStore.getters.all;

export const clearCategories = () => {
    categoryStore.setters.clear();
    categoriesInitialized.value = false;
}

export const getCategoriesSortedBy = (columnName: string, asc: boolean = true): ComputedRef<Category[]> => {
    return categoryStore.getters.sortedByField(columnName, asc) as ComputedRef<Category[]>;
}

export const addCategory = async (newCategory: any) => {
    await categoryStore.actions.create(newCategory);
    categoryStore.actions.getAll();
}