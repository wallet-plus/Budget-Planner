export interface RegisterRequest {
  name: string;
  email: string;
  phone: string;
  password: string;
  terms: boolean;
}

export interface LoginRequest {
    email: string;
    password: string;
  }
  

  export interface ForgotPasswordRequest {
    email: string;
  }

  export interface ErrorResponse {
    error: string; 
  }