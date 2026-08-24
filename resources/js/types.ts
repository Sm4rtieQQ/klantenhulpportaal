export interface Ticket {
    id: number,
    title: string,
    categories: string,
    status: string,
    created_by: string,
    assigned_to: string | null,
    updated_at: string,
    created_at: string,
}

export interface User {
    id: number,
    name: string,
    surname: string,
    role: string,
    tel: string,
    email: string,
    admin: boolean,
    created_at: string,
}