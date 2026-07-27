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