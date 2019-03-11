import ListProduct from '@product/vue/Product/ListProduct'
import EditProduct from '@product/vue/Product/EditProduct'
import ProductCategory from '@product/vue/ProductCategory/ListProductCategory'
import EditProductCategory from '@product/vue/ProductCategory/EditProductCategory'
import TypeProduct from '@product/vue/TypeProduct/ListTypeProduct'
import EditTypeProduct from '@product/vue/TypeProduct/EditTypeProduct'
import LineProduct from '@product/vue/LineProduct/ListLineProduct'
import EditLineProduct from '@product/vue/LineProduct/EditLineProduct'
import ListAttributes from '@product/vue/Attribute/ListAttribute'
import EditAttribute from '@product/vue/Attribute/EditAttribute'
import ListAttributeUnit from '@product/vue/AttributeUnit/ListAttributeUnit'
import EditAttributeUnit from '@product/vue/AttributeUnit/EditAttributeUnit'
import ListAttributeGroup from '@product/vue/AttributeGroup/ListAttributeGroup'
import EditAttributeGroup from '@product/vue/AttributeGroup/EditAttributeGroup'
import AttributeBinding from '@product/vue/Attribute/AttributeBinding'
import ListTnved from '@product/vue/Tnved/ListTnved'
import EditTnved from '@product/vue/Tnved/EditTnved'
import ListProducer from '@product/vue/Producer/ListProducer'
import EditProducer from '@product/vue/Producer/EditProducer'
import ListAttributeValue from '@product/vue/AttributeValue/ListAttributeValue'
import AdminLoginForm from '@auth/vue/AdminLoginForm'
import AdminRegister from '@auth/vue/AdminRegister'
import Admin from '@/components/Admin'
import ListArticles from '@article/vue/ListArticles'
import EditArticle from '@article/vue/EditArticle'
import News from '@news/vue/News/ListNews'
import EditNews from '@news/vue/News/EditNews'
import ListPage from '@pages/vue/pages/ListPage'
import EditPage from '@pages/vue/pages/EditPage'
//const EditProducer = () => import('@product/vue/Producer/EditProducer')

import store from '@/vuex/states'

const ifAuthenticated = (to, from, next) => {
  if(!!localStorage.getItem('user-token')) {
    next()
    return
  }
  next('/login')
}

export const routes = [
  {
    path: '/',
    redirect: '/product'
  },
  {
    path:'/login',
    name: 'login',
    component: AdminLoginForm
  },
  {
    path: '/registration',
    name: 'registration',
    component: AdminRegister
  },
  {
    path: '/product',
    component: Admin,
    beforeEnter: ifAuthenticated,
    children: [
      {
        path: '/',
        name: 'list-product',
        component: ListProduct,
      },
      {
        path: '/edit/:id',
        name: 'edit-product',
        component: EditProduct,
        props: true
      },
      {
        path:'/attribute-values/:id',
        name: 'attribute-values',
        component: ListAttributeValue,
        props: true
      },
      {
        path: '/attribute/edit/:id',
        name: 'edit-attribute',
        component: EditAttribute,
        props: true
      },
      {
        path: '/binding',
        name: 'attribute-binding',
        component: AttributeBinding
      },
      {
        path: '/categories',
        name: 'product-categories-list',
        component: ProductCategory
      },
      {
        path: '/categories/edit/:id',
        name: 'edit-product-category',
        component: EditProductCategory,
        props: true
      },
      {
        path: '/types',
        name: 'product-types-list',
        component: TypeProduct
      },
      {
        path: '/types/edit/:id',
        name: 'edit-product-type',
        component: EditTypeProduct,
        props: true
      },
      {
        path: '/lines',
        name: 'product-lines-list',
        component: LineProduct
      },
      {
        path: '/lines/edit/:id',
        name: 'edit-line-product',
        component: EditLineProduct,
        props: true
      },
      {
        path: '/attributes',
        name: 'product-attributes-list',
        component: ListAttributes
      },
      {
        path: '/product/attributes/edit/:id',
        name: 'edit-attributes-product',
        component: EditAttribute,
        props: true
      },
      {
        path: '/attributes-unit',
        name: 'product-attributes-unit-list',
        component: ListAttributeUnit
      },
      {
        path: '/attributes-unit/edit/:id',
        name: 'edit-attributes-unit-product',
        component: EditAttributeUnit,
        props: true
      },
      {
        path: '/attributes-group',
        name: 'product-attributes-group-list',
        component: ListAttributeGroup
      },
      {
        path: '/attributes-group/edit/:id',
        name: 'edit-attributes-group-product',
        component: EditAttributeGroup,
        props: true
      },
      {
        path: '/tnved',
        name: 'product-tnved-list',
        component: ListTnved
      },
      {
        path: '/tnved/edit/:id',
        name: 'edit-tnved-product',
        component: EditTnved,
        props: true
      },
      {
        path: '/producer',
        name: 'product-producer-list',
        component: ListProducer
      },
      {
        path: '/producer/edit/:id',
        name: 'edit-producer-product',
        component: EditProducer,
        props: true
      },
      {
        path: '/articles',
        name: 'articles',
        component: ListArticles
      },
      {
        path: '/articles/edit/:id',
        name: 'edit-articles',
        component: EditArticle,
        props: true
      },
      {
        path: '/news',
        name: 'news',
        component: News
      },
      {
        path: '/news/edit/:id',
        name: 'edit-news',
        component: EditNews,
        props: true
      },
      {
        path: '/pages',
        name: 'pages',
        component: ListPage
      },
      {
        path: '/pages/edit/:id',
        name: 'edit-pages',
        component: EditPage,
        props: true
      }
    ]
  }
];