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


export interface StatisticsRequest {
    startDate: string;
    endDate: string;
    metrics?: string[]; // Optional: Specific metrics you want to fetch
    filters?: { [key: string]: any }; // Optional: Additional filters
  }

  export interface Category {
    category_name: string;
    category_image: string;
    id_type: string;
    total: string;
  }
  
  export interface ExpenseData {
    amount: string;
    date_of_transaction: string;
  }
  
  export interface StatisticsResponse {
    categories: Category[];
    categoryImagePath: string;
    expenditureTotal: string;
    expenseData: ExpenseData[];
    expenseTotal: string;
    incomeTotal: string;
  }
  

  export interface Category {
    id_category: number;
    id_type: string;
    id_user: number;
    category_name: string;
    category_description: string;
    category_image: string;
    parent: number | null;
    status: number;
  }

  export interface CategoryListRequest {
    type: string; 
  }

  export interface CategoryListResponse {
    categories: Category[];
  }

  export interface TransactionRequest {
    date_of_transaction: string;
    id_type: number;
    id_customer: number;
    id_category: string;
    expense_name: string;
    description: string;
    amount: string;
    deleted: number;
    id_expense?: number; // Optional, in case of new expenses
  }
  
  export interface TransactionResponse {
    date_of_transaction: string;
    id_type: number;
    id_customer: number;
    id_category: string;
    expense_name: string;
    description: string;
    amount: string;
    deleted: number;
    date_created: {
      expression: string;
      params: any[];
    };
    id_expense: number;
  }