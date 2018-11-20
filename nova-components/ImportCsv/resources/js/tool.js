Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'import-csv',
            path: '/import-csv',
            component: require('./components/Tool'),
        },
    ])
})
