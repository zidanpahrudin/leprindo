import { ThemeToggle } from "@/components/theme/theme-toggle";
import {Head} from "@inertiajs/react";

export function PageLayout({
    children,
    title,
  }: any) {
  return (
    <>
      <Head title={title ?? 'Shadcn Admin by @Kai from Binjuhor'}/>
      <ThemeToggle/>
      {children}
    </>
  )
}
