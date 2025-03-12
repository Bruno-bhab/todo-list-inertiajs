interface ILinkItem {
    id: number;
    name: string;
    url: string;
    link_id: number;
    created_at: string;
    updated_at: string;
}

export interface ILink {
    id: number;
    title: string;
    description: string;
    logo: string;
    color: string;
    text_color: string;
    link_name: string;
    user_id: number;
    created_at: string;
    updated_at: string;
    link_items: ILinkItem[];
}
