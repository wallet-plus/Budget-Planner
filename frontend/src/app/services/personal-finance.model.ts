export interface TransactionRequest {
    type: number;
}
export interface TransactionResponse {
    categoryImagePath: string;
    imagePath: string;
    list: Transaction[];
}

export interface Transaction {
    amount: string;
    category_description: string;
    category_image: string;
    category_name: string;
    created_by: string | null;
    date_created: string;
    date_of_transaction: string;
    date_updated: string;
    deleted: string;
    description: string;
    expense_name: string;
    id_category: string;
    id_customer: string;
    id_expense: string;
    id_type: string;
    id_user: string;
    image: string | null;
    name: string;
    parent: string | null;
    status: string;
    updated_by: string | null;
}
