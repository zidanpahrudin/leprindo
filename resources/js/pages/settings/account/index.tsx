import ContentSection from '../components/content-section'
import { AccountForm } from './account-form'
import { Head } from '@inertiajs/react'

export default function SettingsAccount() {
  return (
    <>
      <Head title='Account Settings' />
        <ContentSection
          title='Account'
          desc='Update your account settings. Set your preferred language and
              timezone.'
        >
          <AccountForm />
        </ContentSection>
    </>
  )
}
