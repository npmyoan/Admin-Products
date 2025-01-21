import { safeParse } from "valibot";
import {
  DraftProductSchema,
  ProductsSchema,
  Product,
  ProductSchema,
} from "../types";
import axios from "axios";

type ProductData = {
  [k: string]: FormDataEntryValue;
};
export const addProduct = async (data: ProductData) => {
  try {
    const result = safeParse(DraftProductSchema, {
      name: data.name,
      price: +data.price,
    });
    if (result.success) {
      const url = `${import.meta.env?.VITE_URL_API}/products`;
      const { data } = await axios.post(url, {
        name: result.output.name,
        price: result.output.price,
      });

      return data;
    } else {
      throw new Error("Datos no válidos");
    }
  } catch (error) {
    console.log(error);
  }
};

export const getProducts = async () => {
  try {
    const url = `${import.meta.env?.VITE_URL_API}/products`;
    const { data } = await axios.get(url);
    const result = safeParse(ProductsSchema, data.data);
    if (result.success) {
      return result.output;
    } else {
      throw new Error("Hubo un error...");
    }
  } catch (error) {
    console.log(error);
  }
};

export const getProductById = async (productId: Product["id"]) => {
  try {
    const url = `${import.meta.env?.VITE_URL_API}/products/${productId}`;
    const { data } = await axios.get(url);
    const result = safeParse(ProductSchema, data.data);

    if (result.success) {
      return result.output;
    } else {
      throw new Error("Hubo un error...");
    }
  } catch (error) {
    console.log(error);
  }
};

export const updateProductById = async (
  product: ProductData,
  productId: Product["id"]
) => {
  try {
    const url = `${import.meta.env?.VITE_URL_API}/products/${productId}`;
    const { data } = await axios.put(url, product);
    const result = safeParse(ProductSchema, {
      id: productId,
      price: +data.price,
      availability: data.availability,
    });

    if (result.success) {
      return result.output;
    } else {
      throw new Error("Hubo un error...");
    }
  } catch (error) {
    console.log(error);
  }
};

export const destroyProductById = async (productId: Product["id"]) => {
  try {
    const url = `${import.meta.env?.VITE_URL_API}/products/${productId}`;
    const { status } = await axios.delete(url);
    if (!status) {
      throw new Error("Ups hubo un error.");
    }
    return true;
  } catch (error) {
    console.log(error);
  }
};

export const updateProductByIdAvailability = async (
  productId: Product["id"]
) => {
  try {
    const url = `${
      import.meta.env?.VITE_URL_API
    }/products/${productId}/updateAvailability`;
    const { data } = await axios.patch(url);
    return data;
  } catch (error) {
    console.log(error);
  }
};
