<style>
    .page-item {
        margin-right: 10px;
    }
    .page-item.active .page-link {
        background-color: var(--prem-primary-color, #0d6efd) !important;
        border-color: var(--prem-primary-color, #0d6efd) !important;
        color: #fff !important;
    }
    .page-link:hover {
        background-color: #000 !important;
        color: #fff !important;
    }
    nav > div:first-child {
        display: none !important;
    }
    nav .d-none.flex-sm-fill.d-sm-flex.align-items-sm-center.justify-content-sm-between > div:first-child {
        display: none !important;
    }
    nav .d-none.flex-sm-fill.d-sm-flex.align-items-sm-center.justify-content-sm-between > div:last-child {
        width: 100%;
        display: flex;
        justify-content: center;
    }
</style>

<div>
    {!! $paginator->withQueryString()->links() !!}
</div>
