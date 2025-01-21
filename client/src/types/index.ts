import { number, object, string, InferOutput, array } from "valibot";

export const DraftProductSchema = object({
  name: string(),
  price: number(),
});

export const ProductSchema = object({
  id: number(),
  name: string(),
  price: number(),
  availability: number(),
  created_at: string(),
  updated_at: string(),
});
export const ProductsSchema = array(ProductSchema);
export type Product = InferOutput<typeof ProductSchema>;
