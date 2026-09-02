import type { Router } from 'vue-router';

let routerInstance: Router | null = null;

export const setRouter = (router: Router) => {
    routerInstance = router;
};

export const getRouter = (): Router => {
    if (!routerInstance) {
        throw new Error('Router has not been initialized yet.');
    }

    return routerInstance;
};
