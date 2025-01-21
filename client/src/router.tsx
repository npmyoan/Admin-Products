import { createBrowserRouter } from "react-router-dom";
import Layout from "./layouts/Layout";
import Products, {
  loader as productsLoader,
  action as updateAvailabilityAction,
} from "./views/Products";
import NewProduct, { action as newProductAction } from "./views/NewProduct";
import { action as productDeleteAction } from "./components/ProductDetails";
import ProductEdit, {
  loader as productEditLoader,
  action as productUpdateAction,
} from "./views/ProductEdit";
export const router = createBrowserRouter([
  {
    path: "",
    element: <Layout />,
    children: [
      {
        index: true,
        element: <Products />,
        loader: productsLoader,
        action: updateAvailabilityAction,
      },
      {
        path: "productos/nuevo",
        element: <NewProduct />,
        action: newProductAction,
      },
      {
        path: "productos/:id/editar",
        element: <ProductEdit />,
        action: productUpdateAction,
        loader: productEditLoader,
      },
      {
        path: "productos/:id/eliminar",
        action: productDeleteAction,
      },
    ],
  },
]);
