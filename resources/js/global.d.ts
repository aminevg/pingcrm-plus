import ziggyRouteFunction from "@types/ziggy-js";

// https://github.com/tighten/ziggy/discussions/516#discussioncomment-3486900
declare global {
    const route: typeof ziggyRouteFunction;
}
declare module "@vue/runtime-core" {
    interface ComponentCustomProperties {
        route: typeof ziggyRouteFunction;
    }
}

export type User = {
    id: number;
    name: string;
    email: string;
};
interface PropsInterface {
    auth: {
        user?: User;
    };
    flash?: {
        success: string | null;
        error: string | null;
    };
    errors?: Record<string, string>;
}
