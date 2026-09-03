export interface Category {
    id: number,
    name: string,
    entries: number,
}

export interface Comment {
    id: number,
    ticket_id: number,
    created_by: string,
    body: string,
    created_at: string,
}

export interface Ticket {
    id: number,
    title: string,
    categories: string,
    body: string,
    status: string,
    status_description: string,
    created_by: string,
    assigned_to: string | null,
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
}