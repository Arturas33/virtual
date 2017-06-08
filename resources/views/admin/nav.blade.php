
<div id ="menu">
    <h1>Admin panel</h1>
    <ul>
        <li><a href=" {{ '/admin/lenguage' }}"> {{trans('app.language')}}</a></li>
        <li><a href=" {{ '/admin/pages' }}"> {{trans('app.pages')}} </a></li>
        <li><a href= "{{ '/admin/categories' }}"> {{trans('app.categories')}} </a></li>
        <li><a href= "{{ '/admin/menu' }}"> {{trans('app.menu')}} </a></li>
        <li><a href= "{{ '/admin/orders' }}"> {{trans('app.orders')}} </a></li>
        <li><a href= "{{ '/admin/users' }}"> {{trans('app.user')}} </a></li>
    </ul>
</div>