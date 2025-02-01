import { HTMLAttributes } from 'react'
import { Link, useForm as useInertiaForm } from '@inertiajs/react'
import { useForm } from 'react-hook-form'
import { cn } from '@/lib/utils'
import { Button } from '@/components/ui/button'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { PasswordInput } from '@/components/password-input'

interface SignUpFormProps extends HTMLAttributes<HTMLDivElement> {
  className?: string;
}

export function SignUpForm({ className, ...props }: SignUpFormProps) {
  // Inertia form handling
  const { data, setData, post, processing, errors } = useInertiaForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  });

  // React Hook Form for Shadcn UI components
  const form = useForm({
    defaultValues: {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    }
  });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    post(route('register'), {
      preserveScroll: true,
      onSuccess: () => {
        setData('password', '');
        setData('password_confirmation', '');
        form.reset({
          ...form.getValues(),
          password: '',
          password_confirmation: ''
        });
      },
    });
  };

  return (
    <div className={cn('grid gap-6', className)} {...props}>
      <Form {...form}>
        <form onSubmit={handleSubmit} noValidate>
          <div className='grid gap-4'>
            <FormField
              control={form.control}
              name="name"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Name</FormLabel>
                  <FormControl>
                    <Input
                      placeholder="Enter your name"
                      autoComplete="name"
                      value={data.name}
                      onChange={(e) => {
                        field.onChange(e);
                        setData('name', e.target.value);
                      }}
                      aria-invalid={!!errors.name}
                    />
                  </FormControl>
                  {errors.name && (
                    <FormMessage>{errors.name}</FormMessage>
                  )}
                </FormItem>
              )}
            />

            <FormField
              control={form.control}
              name="email"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Email</FormLabel>
                  <FormControl>
                    <Input
                      type="email"
                      placeholder="name@example.com"
                      autoComplete="username"
                      value={data.email}
                      onChange={(e) => {
                        field.onChange(e);
                        setData('email', e.target.value);
                      }}
                      aria-invalid={!!errors.email}
                    />
                  </FormControl>
                  {errors.email && (
                    <FormMessage>{errors.email}</FormMessage>
                  )}
                </FormItem>
              )}
            />

            <FormField
              control={form.control}
              name="password"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Password</FormLabel>
                  <FormControl>
                    <PasswordInput
                      placeholder="Create a password"
                      autoComplete="new-password"
                      value={data.password}
                      onChange={(e) => {
                        field.onChange(e);
                        setData('password', e.target.value);
                      }}
                      aria-invalid={!!errors.password}
                    />
                  </FormControl>
                  {errors.password && (
                    <FormMessage>{errors.password}</FormMessage>
                  )}
                </FormItem>
              )}
            />

            <FormField
              control={form.control}
              name="password_confirmation"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Confirm Password</FormLabel>
                  <FormControl>
                    <PasswordInput
                      placeholder="Confirm your password"
                      autoComplete="new-password"
                      value={data.password_confirmation}
                      onChange={(e) => {
                        field.onChange(e);
                        setData('password_confirmation', e.target.value);
                      }}
                      aria-invalid={!!errors.password_confirmation}
                    />
                  </FormControl>
                  {errors.password_confirmation && (
                    <FormMessage>{errors.password_confirmation}</FormMessage>
                  )}
                </FormItem>
              )}
            />

            <div className="flex items-center justify-between mt-2">
              <Link
                href={route('login')}
                className="text-sm text-muted-foreground hover:text-primary"
              >
                Already have an account?
              </Link>

              <Button type="submit" disabled={processing}>
                {processing ? 'Creating account...' : 'Create account'}
              </Button>
            </div>
          </div>
        </form>
      </Form>
    </div>
  );
}

export default SignUpForm;
