import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    role: UserRole;
    email: string;
    email_verified_at?: string | null;
    created_at: string;
    updated_at: string;
    
    // Children
    orders?: Order[];
    profile?: Profile | null;
}

export type UserRole = 'admin' | 'customer';

export interface Profile {
    id: number;
    user_id: number;
    phone_number?: string | null;
    address?: string | null;
    avatar_url?: string | null;
    created_at: string;
    updated_at: string;

    // Parent
    user?: User;
}

export interface Order {
    id: number;
    user_id: number;
    invoice_number: string;
    shipping_address: string;
    shipping_cost: number;
    status: OrderStatus;
    created_at: string;
    updated_at: string;

    // Parent
    user: User;

    // Children
    orderDetails: OrderDetail[];
    payment: Payment;
}

export type OrderStatus = 'pending' | 'paid' | 'processing' | 'shipped' | 'completed' | 'cancelled';

export interface OrderDetail {
    id: number;
    order_id: number;
    product_id: number;
    quantity: number;
    price: number;
    created_at: string;
    updated_at: string;

    // Parent
    order: Order;
    product: Product;
}

export interface Payment {
    id: number;
    order_id: number;
    amount: number;
    status: PaymentStatus;
    created_at: string;
    updated_at: string;

    // Parent
    order: Order;
}

export type PaymentStatus = 'pending' | 'success' | 'failed';

export interface Category {
    id: number;
    name: string;
    slug: string;
    created_at: string;
    updated_at: string;
    deleted_at: string;

    // Children
    products?: Product[];
}

export interface Product {
    id: number;
    category_id: number;
    name: string;
    slug: string;
    description?: string | null;
    price: number;
    discount_percentage: number;
    created_at: string;
    updated_at: string;
    deleted_at: string;

    // Parent
    category: Category;

    // Children
    orderDetails?: OrderDetail[];
    productVariants?: ProductVariant[];
}

export interface ProductVariant {
    id: number;
    product_id: number;
    sku: string;
    slug:string;
    size: string;
    color:string;
    stock: number;
    created_at: string;
    updated_at: string;
    deleted_at: string;

    // Parent
    product: Product;

    // Children
    productImages?: ProductImage[];
}

export interface ProductImage {
    id: number;
    product_variant_id: number;
    url: string;

    // Parent
    productVariant: ProductVariant;
}
