export interface Category {
    id: number,
    name: string,
    entries: number,
}

export interface Comment {
    id: number,
    ticket_id: number,
    created_by: string,
    created_by_id: number,
    body: string,
    created_at: string,
}

export interface Ticket {
    id: number,
    title: string,
    categories?: Category[],
    body: string,
    status: number,
    status_description: string,
    created_by: string,
    created_by_id: number,
    assigned_to?: string | null,
    assigned_to_id?: number | null,
    updated_at: string,
    created_at: string,
}

export interface Note {
    id: number,
    ticket_id: number,
    created_by: string,
    body: string,
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
    verified_at: string | null,
}
