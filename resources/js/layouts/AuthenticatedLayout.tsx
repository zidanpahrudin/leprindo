import { AppSidebar } from "@/components/app-sidebar"
import { Header } from '@/components/layout/header'
import { TopNav } from '@/components/layout/top-nav'
import { ProfileDropdown } from '@/components/profile-dropdown'
import { Search } from '@/components/search'

import {
    SidebarInset,
    SidebarProvider,
} from "@/components/ui/sidebar"


const topNav = [
    {
        title: 'Overview',
        href: 'dashboard/overview',
        isActive: true,
        disabled: false,
    },
    {
        title: 'Customers',
        href: 'dashboard/customers',
        isActive: false,
        disabled: true,
    },
    {
        title: 'Products',
        href: 'dashboard/products',
        isActive: false,
        disabled: true,
    },
    {
        title: 'Settings',
        href: 'dashboard/settings',
        isActive: false,
        disabled: true,
    },
]
export function AuthenticatedLayout({ children } : any ) {
    return (
        <SidebarProvider>
            <AppSidebar />
            <SidebarInset>
                <Header>
                    <TopNav links={topNav} />
                    <div className='ml-auto flex items-center space-x-4'>
                        <Search />
                        <ProfileDropdown />
                    </div>
                </Header>

                <div className="flex flex-1 flex-col gap-4 p-4 pt-0">
                    { children }
                </div>
            </SidebarInset>
        </SidebarProvider>
    )
}
