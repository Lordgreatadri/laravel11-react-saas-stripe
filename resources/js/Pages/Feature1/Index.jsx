import Feature from "../../Components/Feature";
import InputError from '../../Components/InputError';
import InputLabel from '../../Components/InputLabel';
import PrimaryButton from '../../Components/PrimaryButton';
import TextInput from '../../Components/TextInput';

export default function Index({feature, answer } ){
    const {data, setData, post, reset, errors, processing} = useForm({
        number1: "",
        number2: "",
    })

    const submit = (e) => {
        e.preventDefault();
        
        post(route('feature1.calculate'),{
            onSuccess(){
                reset();
            }
        })
    }


    return (
        <Feature feaure={feature} answer={answer}>
            <h2>Feature 1</h2>
            <form onSubmit={submit} className="p-8 grid gid-col-2 gap-3">
                <div >
                    <InputLabel htmlFor="number1" value="Number 1"/>
                    <TextInput className="mt-1 block w-full"
                        id="number1" name="number1" type="text"
                        value={data.number1}
                        onChange={(e)=> setData("number1", e.target.value)}/>
                        <InputError message ={errors.number1} className="mt-2"/>
                </div>
                <div >
                    <InputLabel htmlFor="number2" value="Number 2"/>
                    <TextInput className="mt-1 block w-full"
                        id="number2" name="number2" type="text"
                        value={data.number2}
                        onChange={(e)=> setData("number2", e.target.value)}/>
                        <InputError message ={errors.number2} className="mt-2"/>
                </div>
                <PrimaryButton type="submit" disabled={processing}>Calculate</PrimaryButton>
            </form>
        </Feature>
    )
}







